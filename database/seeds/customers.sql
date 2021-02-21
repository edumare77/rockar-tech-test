LOAD DATA INFILE '%s' 
    IGNORE INTO TABLE customers 
    CHARACTER SET utf8 FIELDS 
    TERMINATED BY ',' 
    ENCLOSED BY '\"' 
    ESCAPED BY '' 
    LINES TERMINATED BY '\n' 
    IGNORE 1 LINES 
    (email,forename,surname,contact_number,postcode, @created_at, @updated_at) 
    SET created_at=NOW(), updated_at=NOW()