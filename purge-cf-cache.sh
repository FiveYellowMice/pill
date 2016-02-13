#!/bin/bash

curl -X DELETE "https://api.cloudflare.com/client/v4/zones/$(cat ./cf_zone_id)/purge_cache" \
	-H "X-Auth-Email: hkz85825915@gmail.com" \
	-H "X-Auth-Key: $(cat ~/Utils/cf_apikey)" \
	-H "Content-Type: application/json" \
	-d '{"files": ["https://pill.fiveyellowmice.com/", "https://pill.fiveyellowmice.com/feed.xml"]}'
