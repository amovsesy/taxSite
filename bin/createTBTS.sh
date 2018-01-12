#!/bin/bash

cd ../locale
eng=`grep -v '?>' en.php | grep -v "//" | grep -v "<?php" | grep -v "^$" | awk -F "\"" '{print $2}'`

files=`find . | grep ".php" | grep -v "en.php" | grep -v "tmp" | grep -v "svn"`
for f in $files
do
  f1=`echo "$f"_tmp`
  for prop in $eng
  do
    res=`grep $prop $f | wc -l`
    if [ $res -eq 0 ]; then
      str=`grep \"$prop\" en.php | awk -F "\"" '{print $4}'`
      echo "define(\"$prop\", \"TBT: $str\");" >> $f1
    fi
  done
  f2=`echo "$f"_tmp2`
  cat $f | grep -v '?>' > $f2
  cat $f2 $f1 > $f 2> /dev/null
  echo '?>' >> $f
  rm $f1 $f2 2> /dev/null
done
