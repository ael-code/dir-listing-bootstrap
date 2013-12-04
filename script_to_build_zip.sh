#!/bin/bash

function helpf {
	echo -e "\nScript to build zip package for dir-listing-bootstrap"
	echo -e "\nUsage: $0 \"version_number\""
	exit
}

if [ $# != 1 ]; then
helpf
fi

echo -e "\ngenerating new zip package version $1"

files="dir_listing.php dir_listing_config.php dir_listing_func.php favicon32.ico LICENSE README.md bootstrap"

echo "creating temp folder \"dirl\"..."
mkdir dirl

echo "coping temp files..."
cp -r $files dirl

echo "changing"
sed -i "s/Ael's php directory listing/Ael's php directory listing v$1/" dirl/dir_listing.php


echo -e "zipping...\n"
zip -r9 dir-listing-bootstrap_v$1.zip dirl

echo "removing temp files..."
rm -r dirl
