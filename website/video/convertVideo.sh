#!/bin/bash

filename=$(basename -- "$fullfile")
filename="${filename%.*}"

if test -f "$FILE"; then
echo "Do you wish to install this program?"
select yn in "Yes" "No"; do
    case $yn in
        Yes ) break;;
        No ) exit;;
    esac
done
rm ${filename}_*.webm


ffmpeg -i $1 -c:v libvpx-vp9 -keyint_min 150 \
-g 150 -tile-columns 4 -frame-parallel 1  -f webm -dash 1 \
-an -vf scale=160:90 -b:v 250k -dash 1 ${filename}_160x90_250k.webm \
-an -vf scale=320:180 -b:v 500k -dash 1 ${filename}_320x180_500k.webm \
-an -vf scale=640:360 -b:v 750k -dash 1 ${filename}_640x360_750k.webm \
-an -vf scale=640:360 -b:v 1000k -dash 1 ${filename}_640x360_1000k.webm \
-an -vf scale=1280:720 -b:v 1500k -dash 1 ${filename}_1280x720_1500k.webm

ffmpeg \
  -f webm_dash_manifest -i ${filename}_160x90_250k.webm \
  -f webm_dash_manifest -i ${filename}_320x180_500k.webm \
  -f webm_dash_manifest -i ${filename}_640x360_750k.webm \
  -f webm_dash_manifest -i ${filename}_640x360_1000k.webm \
  -f webm_dash_manifest -i ${filename}_1280x720_1500k.webm \
  -c copy \
  -map 0 -map 1 -map 2 -map 3 -map 4\
  -f webm_dash_manifest \
  -adaptation_sets "id=0,streams=0,1,2,3,4" \
  ${filename}_manifest.mpd