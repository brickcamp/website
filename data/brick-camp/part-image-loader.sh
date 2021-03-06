#!/bin/bash
##########################################################################################
#
# Downloading part images from rebrickable.com and collecting one of each part into
# a single folder. The images are picked by the total popularity of the color - not
# the per-part-popularity of the color. Existing images in the folder are kept.
#
##########################################################################################
# Configuration
##########################################################################################
    targetFolder="../../pages/images/tax-part"
    workingFolder="temp"
    downloadPage="https://rebrickable.com/downloads/"
    partFilePattern="https://cdn.rebrickable.com/media/downloads/ldraw/parts_[[:digit:]]+.zip"
    partFileList="part_links.txt"
    importantColors="216,232,313,462,73,320,272,14,1,4"
    removeDownloads=0
    skipDownloads=0
    clearTargetFolder=1
##########################################################################################
#
# Here we go!
#
##########################################################################################
echo "## Making sure all folders exist"
if [[ -z $targetFolder || ! -d $targetFolder ]]; 
then
    echo " - ERROR: Folder \"$targetFolder\" doesn't exist"
    exit 1
fi
cd $targetFolder

if [[ ! -d $workingFolder ]];
then
    echo " - Create working folder"
    mkdir "$workingFolder"
fi
cd $workingFolder

if [ $? -ne 0 ];
then 
    echo " - ERROR: Failed to enter working folder"
    exit 1
fi

if [ $skipDownloads -eq 0 ];
then
    rm -rf ./*
##########################################################################################
    echo "## Get list of part zip files"
    wget -q -O - $downloadPage | grep -E --only-matching --regexp="$partFilePattern" | sort > $partFileList

##########################################################################################
    echo "## Download zip files"
    wget -q --show-progress --input-file $partFileList
    rm -f $partFileList

##########################################################################################
    echo -n "## Unzip files"
    for zip in *.zip; 
    do
        echo -n "."
        folder=`echo $zip | grep -E --only-matching --regexp="-?[[:digit:]]+"`

        if [[ ! -d "$folder" ]]; 
        then
            mkdir "$folder"
        fi

        cd "$folder"
        if [ $? -ne 0 ];
        then 
            echo " - ERROR: Failed to enter folder $folder"
            exit 1
        fi

        unzip -nq "../$zip"
        cd ..
        rm -f $zip
    done
    echo ""
fi

##########################################################################################
echo "## Prioritize colors"
folders=`du -sk ./* | sort -nr | grep -E --only-matching '\<[[:digit:]]+$'`
IFS=',' read -ra COLORS <<< "$importantColors"

##########################################################################################
cd ..
if [ $clearTargetFolder -eq 1 ];
then
    echo "## Clear target folder"
    ls | grep -E ".png$" | xargs rm -f
fi

##########################################################################################
echo "## Collect prioritized colors into result folder"
for folder in "${COLORS[@]}";
do
    echo -n " $folder"
    if [[ ! -d "$workingFolder/$folder" ]]; 
    then
        echo -n "*"
        continue
    fi

    ls $workingFolder/$folder > $workingFolder/f1.txt
    ls > $workingFolder/f2.txt
    todo=`comm -23 $workingFolder/f1.txt $workingFolder/f2.txt`
    for file in $todo;
    do
        cp $workingFolder/$folder/$file $file
    done
done
echo ""

##########################################################################################
echo "## Collect remaining colors into result folder"
for folder in $folders;
do
    echo -n "$folder "
    if [[ ! -d "$workingFolder/$folder" ]]; 
    then
        echo -n "*"
        continue
    fi

    ls $workingFolder/$folder > $workingFolder/f1.txt
    ls > $workingFolder/f2.txt
    todo=`comm -23 $workingFolder/f1.txt $workingFolder/f2.txt`
    for file in $todo;
    do
        cp $workingFolder/$folder/$file $file
    done
done
echo ""

##########################################################################################
if [ $removeDownloads -eq 1 ];
then 
    rm -rf $workingFolder
fi
echo "## FINISHED"
