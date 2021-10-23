#!/bin/bash

# https://gist.github.com/migrad/20eac62233a31a2fe70e69b31fc02e79
#
# Inspired by
# https://gist.github.com/kizbitz/175be06d0fbbb39bc9bfa6c0cb0d4721
# https://gist.github.com/leetschau/a242b6630628429e3a3853991cb5c318

REPO=$1
NEXT_URL="https://registry.hub.docker.com/v2/repositories/library/${REPO}/tags/?page=1&page_size=100"

# Empty tags
$(cat /dev/null > tags)
$(chmod 775 tags)

until [ $NEXT_URL == 'null' ]
do
  JSON=$(curl -s -S "${NEXT_URL}")

    echo ${JSON} | sed -e 's/,/,\n/g' -e 's/\[/\[\n/g' | \
    grep '"name"' | \
    awk -F\" '{print $4;}' | \
    sort -fu | \
    sed -e "s/^/${REPO}:/" >> tags

    NEXT_URL=$(echo ${JSON} | jq -r '. | .next')
    #echo ${NEXT_URL}
done