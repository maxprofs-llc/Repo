find ../ -iname "*.php" | xargs wc -l | sort -n -k1 -r | grep -v cache | grep -v templates_c | grep -v " total" | awk '{sum+=$1} END{print sum}'
