<?php
function pg_connection_string() {
  return "dbname=d982vlbpdpu737 host=ec2-54-235-162-144.compute-1.amazonaws.com port=5432 user=ydsgglksiqckdh password=SPgVICpqS9AGYXGHwSE65WJLt6 sslmode=require";
}

# Establish db connection
$db = pg_connect(pg_connection_string());
if (!$db) {
    echo "Database connection error.";
    exit;
} 

?>