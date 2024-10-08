#! /bin/sh
#------------------------------------------------------------
# checkssl.sh
# Script checks for number of days until certificate expires or the issuing authority
# depending on switch passed on command line.
# FONET Bilgi Teknolojileri A.S.
#------------------------------------------------------------

DEBUG=0
if [ $DEBUG -gt 0 ]
then
exec 2>>/var/log/zabbix/checkssl.log
set -x
fi

f=$1
host=$2
port=$3
sni=$4
proto=$5

if [ -z "$sni" ]
then
servername=$host
else
servername=$sni
fi

if [ -n "$proto" ]
then
starttls="-starttls $proto"
fi

case $f in
-d)
fix_broken_pipe=`openssl s_client -servername $servername -connect $host:$port -showcerts $starttls </dev/null 2>/dev/null |
sed -n '/BEGIN CERTIFICATE/,/END CERT/p'`

end_date=`echo "$fix_broken_pipe" | openssl x509 -enddate -noout 2>/dev/null |
sed -n 's/notAfter=//p' |
sed 's/ GMT//g'`

if [ -n "$end_date" ]
then
end_date_seconds=`date '+%s' --date "$end_date"`
# end_date_seconds=`date -j -f "%b %d %T %Y" "$end_date" "+%s"`
# echo $end_date
now_seconds=`date '+%s'`
# echo $now_seconds
echo "($end_date_seconds-$now_seconds)/24/3600" | bc
fi
;;

-i)
fix_broken_pipe=`openssl s_client -servername $servername -connect $host:$port -showcerts $starttls </dev/null 2>/dev/null |
sed -n '/BEGIN CERTIFICATE/,/END CERT/p'`

issue_dn=`echo "$fix_broken_pipe" | openssl x509 -issuer -noout 2>/dev/null |
sed -n 's/issuer=//p'`

if [ -n "$issue_dn" ]
then
issuer=`echo $issue_dn | sed -n 's/.*CN=*//p'`
echo $issuer
fi
;;
*)
echo "usage: $0 [-i|-d] hostname port sni"
echo " -i Show Issuer"
echo " -d Show valid days remaining"
;;
esac


