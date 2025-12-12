debian user = 'root';
debian PW = "neues_passwort";

# PHP REST API für Bibliotheksverwaltung

## Übersicht

Dieses Projekt ist eine RESTful API zur Verwaltung von Projekten, Kategorien und Technologien. Die API ist in PHP geschrieben und verwendet eine MySQL/MariaDB-Datenbank. Sie eignet sich als Backend für moderne Webanwendungen (z.B. Next.js Frontend).

---

## Features

- REST-API für Projekte, Kategorien und Technologien
- Routing über zentrale `routes.php`
- Singleton-Pattern für Datenbankzugriff
- PDO für sichere Datenbankabfragen
- CORS-Unterstützung für Cross-Origin-Anfragen
- Automatisches Laden von Klassen via Composer (PSR-4)

---

## Verzeichnisstruktur

```
├── autoload.php
├── composer.json
├── index.php                # Einstiegspunkt, setzt Header & lädt Bootstrap
├── my_bibliothek.sql        # SQL-Skript zur Datenbankerstellung
├── README.md
├── Routes/
│   ├── category.routes.php
│   ├── projects.routes.php
│   ├── routes.php           # Zentrales Routing
│   └── tech.routes.php
└── src/
	 ├── bootstrap.php        # Initialisiert DB & Routing
	 ├── Config/
	 │   ├── AllowCors.php
	 │   └── Config.php       # DB-Konfiguration
	 ├── Database/
	 │   └── Database.php     # PDO-Wrapper
	 ├── Helpers/
	 │   ├── functions.php
	 │   ├── headers.php
	 │   └── populateDb.php
	 └── Models/
		  ├── Bibliothek.php   # Singleton, Einstieg für Models
		  ├── Category.php
		  ├── Project.php
		  ├── ProjectTech.php
		  └── Tech.php
```

---

## Setup & Installation

1. **Repository klonen**
   ```bash
   git clone <repo-url>
   cd nextjs_php_api
   ```
2. **Abhängigkeiten installieren**
   ```bash
   composer install
   ```
3. **Datenbank anlegen**
   - Importiere `my_bibliothek.sql` in deine MySQL/MariaDB-Instanz.
   - Passe ggf. Zugangsdaten in `src/Config/Config.php` an.
4. **Server starten**
   ```bash
   php -S localhost:8000
   ```
   Die API ist dann unter http://localhost:8000 erreichbar.

---

## API-Routing & Endpunkte

Alle Anfragen laufen über `index.php` und werden in `Routes/routes.php` anhand des Parameters `ressource` verteilt:

**Beispiel:**

```
GET /?ressource=project
```

### Verfügbare Ressourcen:

- `project` → Projekte-API (`projects.routes.php`)
- `category` → Kategorien-API (`category.routes.php`)
- `tech` → Technologien-API (`tech.routes.php`)

Die genauen Endpunkte und Methoden findest du in den jeweiligen Routen-Dateien.

---

## Datenbankstruktur (Auszug)

**Tabelle `categories`**
| Spalte | Typ | Beschreibung |
|--------|-------------|---------------------|
| id | int | Primärschlüssel |
| uuid | char(36) | Eindeutige ID (UUID) |
| name | varchar(50) | Name der Kategorie |
| url | varchar(255)| URL zur Kategorie |

**Tabelle `projects`**
| Spalte | Typ | Beschreibung |
|---------------|-------------|-----------------------|
| id | int | Primärschlüssel |
| uuid | char(36) | Eindeutige ID (UUID) |
| name | varchar(50) | Projektname |
| description | varchar(255)| Beschreibung |
| github_url | varchar(255)| (optional) GitHub-Link |
| category_uuid | varchar(36) | Kategorie-UUID |

**Tabelle `tech`** und **`project_tech`** verknüpfen Technologien mit Projekten (siehe SQL).

---

## Beispielanfrage

Alle Anfragen erfolgen per HTTP (GET/POST/PUT/DELETE) mit dem Parameter `ressource`:

```http
GET http://localhost:8000/?ressource=project
```

Antwort (JSON):

```json
[
  {
    "uuid": "...",
    "name": "Projektname",
    "description": "...",
    "github_url": "...",
    "category_uuid": "..."
  }
]
```

---

## Erweiterung & Hinweise

- Neue Ressourcen können durch weitere Routen und Models ergänzt werden.
- Die Datenbankverbindung ist als Singleton implementiert (`Bibliothek.php`).
- CORS ist standardmäßig aktiviert (`AllowCors.php`).
- Für UUIDs wird das Paket `ramsey/uuid` verwendet.

---

## Autor

**dplauder**  
docgit@gmail.com
