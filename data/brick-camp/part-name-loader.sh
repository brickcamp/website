#!/bin/bash
##########################################################################################
#
# Downloading part names as CSV file from rebrickable.com
#
##########################################################################################
# Configuration
##########################################################################################
    downloadLink="https://cdn.rebrickable.com/media/downloads/parts.csv.gz"
##########################################################################################
echo "## Get list of parts"
wget -q $downloadLink  -O - | gunzip -c > part.csv
echo "## FINISHED"
