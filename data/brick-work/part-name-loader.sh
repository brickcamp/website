#!/bin/bash
##########################################################################################
#
# Downloading part names as CSV file from rebrickable.com
#
##########################################################################################
# Configuration
##########################################################################################
    targetFolder="."
    targetFile="parts.csv"
    downloadLink="https://m.rebrickable.com/media/downloads/parts.csv"
##########################################################################################
#
# Here we go!
#
##########################################################################################
echo "## Making sure folder exist"
if [[ -z $targetFolder || ! -d $targetFolder ]]; 
then
    echo " - ERROR: Folder \"$targetFolder\" doesn't exist"
    exit 1
fi
cd $targetFolder

if [ $? -ne 0 ];
then 
    echo " - ERROR: Failed to enter folder"
    exit 1
fi

##########################################################################################
echo "## Get list of parts"
wget -q -O $targetFile $downloadLink
echo "## FINISHED"