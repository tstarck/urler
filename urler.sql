
 -- Database table schemas for urler script
 -- Compatible with PostgreSQL's dialect

CREATE TABLE urler_log (
    url  varchar(640) PRIMARY KEY,
    nick varchar(15) DEFAULT '',
    chan varchar(50) DEFAULT '',
    at   timestamp DEFAULT CURRENT_TIMESTAMP,
    seen BOOLEAN DEFAULT 'false'
);

CREATE FUNCTION urler_save(varchar, varchar, varchar) RETURNS integer AS $$
    INSERT INTO urler_log (url, nick, chan) VALUES ($1, $2, $3);
    SELECT 200;
$$ LANGUAGE SQL;

 -- DROP FUNCTION urler_save(varchar, varchar, varchar);
 -- DROP TABLE urler_log;
