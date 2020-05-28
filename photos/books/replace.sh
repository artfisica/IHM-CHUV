#!/bin/bash
input="$1"
html="$2"
##
lines_array=(27 37 62 72 97 103 132 142 167 177 202 212)
i=-1
##
while IFS= read -r line
do
  i=$((i+1))
  echo "${lines_array[$i]} = $line"
  current_line=${lines_array[$i]}
  sed -i ".bak" "${current_line}s|.*|$line|" $html 
  ##
done < "$input"
##
