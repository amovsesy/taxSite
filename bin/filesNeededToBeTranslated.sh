#!/bin/bash

./createTBTS.sh

cd ../locale

files=`find . | grep ".php" | grep -v "svn" | awk -F "/" '{print $2}'`
for f in $files
do
  num=`grep "TBT:" $f | wc -l`
  if [ $num -ne 0 ]; then
    echo "$f": $num
  fi
done
