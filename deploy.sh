#!/bin/bash

tar --exclude=config.php --exclude='.[^/]*' --exclude=build.sh --exclude=deploy.sh --exclude=pill.tar.gz -acf pill.tar.gz .

scp pill.tar.gz potato1:

rm pill.tar.gz
