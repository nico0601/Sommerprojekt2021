[CmdletBinding()]
param (
    [Parameter(Mandatory)]
    [string]
    $inputFile
)
$videoName = Split-Path $inputFile -LeafBase

# if (Test-Path "${videoName}_160x90_250k.webm") {
#     $title = 'Files Exist'
#     $question = 'Are you sure you want to proceed to overwrite old files?'
#     $choices = '&Yes', '&No'

#     $decision = $Host.UI.PromptForChoice($title, $question, $choices, 1)
#     if ($decision -eq 0) {
#         Write-Host 'Continuing...'
#     }
#     else {
#         Write-Error 'Job Cancelled by User Input'
#         exit
#     }

#     Remove-Item "${videoName}_*.webm"
#     Remove-Item "${videoName}_*.mp4"
# }

# ffmpeg -i $inputFile -c:v libvpx-vp9 -keyint_min 150 -g 150 `
#   -tile-columns 4 -frame-parallel 1  -f webm -dash 1 `
#   -an -vf scale=160:90 -b:v 250k -dash 1 "${videoName}_160x90_250k.webm" `
#   -an -vf scale=320:180 -b:v 500k -dash 1 "${videoName}_320x180_500k.webm" `
#   -an -vf scale=640:360 -b:v 750k -dash 1 "${videoName}_640x360_750k.webm" `
#   -an -vf scale=640:360 -b:v 1000k -dash 1 "${videoName}_640x360_1000k.webm" `
#   -an -vf scale=1280:720 -b:v 1500k -dash 1 "${videoName}_1280x720_1500k.webm"

# ffmpeg -i $inputFile -c:v libvpx-vp9 -keyint_min 150 -g 150 `
#   -tile-columns 4 -frame-parallel 1  -f mp4 -dash 1 `
#   -an -vf scale=160:90 -b:v 250k -dash 1 "${videoName}_160x90_250k.mp4" `
#   -an -vf scale=320:180 -b:v 500k -dash 1 "${videoName}_320x180_500k.mp4" `
#   -an -vf scale=640:360 -b:v 750k -dash 1 "${videoName}_640x360_750k.mp4" `
#   -an -vf scale=640:360 -b:v 1000k -dash 1 "${videoName}_640x360_1000k.mp4" `
#   -an -vf scale=1280:720 -b:v 1500k -dash 1 "${videoName}_1280x720_1500k.mp4"

ffmpeg `
  -f webm_dash_manifest -i "${videoName}_160x90_250k.webm" `
  -f webm_dash_manifest -i "${videoName}_320x180_500k.webm" `
  -f webm_dash_manifest -i "${videoName}_640x360_750k.webm" `
  -f webm_dash_manifest -i "${videoName}_640x360_1000k.webm" `
  -f webm_dash_manifest -i "${videoName}_1280x720_1500k.webm" `
  -c copy -map 0 -map 1 -map 2 -map 3 -map 4 `
  -f webm_dash_manifest -adaptation_sets "id=0,streams=0,1,2,3,4" "${videoName}_webm_manifest.xml"

ffmpeg `
  -f mpeg_dash_manifest -i "${videoName}_160x90_250k.mp4" `
  -f mpeg_dash_manifest -i "${videoName}_320x180_500k.mp4" `
  -f mpeg_dash_manifest -i "${videoName}_640x360_750k.mp4" `
  -f mpeg_dash_manifest -i "${videoName}_640x360_1000k.mp4" `
  -f mpeg_dash_manifest -i "${videoName}_1280x720_1500k.mp4" `
  -c copy -map 0 -map 1 -map 2 -map 3 -map 4 `
  -f mpeg_dash_manifest -adaptation_sets "id=0,streams=0,1,2,3,4" "${videoName}_mp4_manifest.xml"
