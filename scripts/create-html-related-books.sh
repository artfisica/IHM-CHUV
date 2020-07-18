#!/bin/bash
source data.txt
photo="$1"
tail=`echo ${photo:0:1}.${photo:1:2}`

echo $tail

eval varAlias=( '"${replacement'${photo}'[@]}"' )
for row in "${varAlias[@]}"
do
    original="$(echo $row | cut -d~ -f1)";
    new="$(echo $row | cut -d~ -f2)";
    sed -i -e "s/${original}/${new}/g" books-matrix-$tail.html;
done

rm -rf books-matrix-*.html-e

#end
