BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "comptes" (
	"login"	varchar NOT NULL DEFAULT (null),
	"password"	varchar DEFAULT (null),
	"statut"	varchar NOT NULL DEFAULT utilisateur,
	PRIMARY KEY("login"),
	CHECK (statut IN('administrateur','utilisateur'))
);
INSERT INTO "comptes" ("login","password","statut") VALUES ('Mathys@compta.fr','mathys','administrateur'),
 ('Quentin@compta.fr','quentin','administrateur'),
 ('Jean@client.fr','Jean','utilisateur'),
 ('Abigail@client.fr','Abigail','utilisateur'),
 ('Loic@client.fr','Loic','utilisateur'),
 ('Damien@client.fr','Damien','utilisateur'),
 ('Leo@client.fr','Leo','utilisateur'),
 ('Astrid@client.fr','Astrid','utilisateur');
COMMIT;
