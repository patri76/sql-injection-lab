First time launch:
- Change DB credentials in db_connection.php
- Run php -S localhost:8000 (another port if 8000 is already used)
- In browser go to localhost:8000/create_tables.php
- Enjoy



In questo progetto :

Per prima cosa ho avviato il progetto in locale utilizzando il server PHP e ho creato il database tramite il file create_tables.php.

Successivamente ho testato la funzionalità di ricerca dei film. Inserendo un apice (') nella barra di ricerca ho ottenuto un errore SQL, segno che l’input dell’utente veniva inserito direttamente nella query.

Ho poi inserito la stringa:
' OR 1=1-- -

In questo modo sono riuscita a visualizzare tutti i film presenti nel database, dimostrando la presenza della vulnerabilità SQL Injection.

Dopo aver individuato il problema, ho provato a modificare il codice sostituendo la query vulnerabile con una versione sicura utilizzando i prepared statements.

Infine ho ripetuto i due test:
- inserendo ' non si verifica più errore
- inserendo ' OR 1=1-- - la query non viene più manipolata

penso che la vulnerabilità ora sia stata corretta.

