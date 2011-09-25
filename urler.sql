
 -- Database table schemas for urler script
 -- Compatible with PostgreSQL's dialect

CREATE TABLE urler_log (
    url	varchar(640) PRIMARY KEY,
    at	timestamp DEFAULT CURRENT_TIMESTAMP
);

CREATE FUNCTION urler_save(varchar) RETURNS integer AS $$
    INSERT INTO urler_log (url) VALUES ($1);
    SELECT 200;
$$ LANGUAGE SQL;

 -- DROP FUNCTION urler_save(varchar);
 -- DROP TABLE urler_log;
