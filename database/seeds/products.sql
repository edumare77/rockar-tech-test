LOAD DATA INFILE '%s' 
IGNORE INTO TABLE products 
CHARACTER SET utf8 FIELDS 
TERMINATED BY ',' 
ENCLOSED BY '\"' 
ESCAPED BY '' 
LINES TERMINATED BY '\n' 
IGNORE 1 LINES 
(vin,colour,make,model,price, @created_at, @updated_at) 
SET created_at=NOW(), updated_at=NOW()