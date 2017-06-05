-- SQLite dialect
CREATE TABLE todo
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT,
    email TEXT,
    text TEXT,
    file TEXT,
    ready INT DEFAULT 0 NOT NULL,
    deleted INT DEFAULT 0 NOT NULL
);

