CREATE TABLE couples ( id varchar(250), couple varchar(250));
CREATE TABLE images ( path varchar(250),couple varchar(250));
CREATE INDEX 'pIndex' ON "images" ("path" ASC)
