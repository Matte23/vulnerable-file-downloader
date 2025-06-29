# Vulnerable file downloader

This project is a simple PHP File Downloader with different vulnerabilities:
* SQL injections
* Command injection
* Local file inclusion
* Various misconfigurations

This webapp was developed to test the Coraza WAF for the course "Network and Cloud security", Cybersecurity MSc of Politecnico di Torino.

## WARNING
This application contains many vulnerabilities that can lead to RCE! **Do not deploy as a public service**, otherwise your server *will* be compromised!

## Setup Instructions
Deploy this project using either the prebuild image or locally by building the project.

### Prebuilt image
Copy following snippet into a file named `docker-compose.yml`
```yaml
version: '3.8'

services:
  db:
    image: mysql:5.7
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: vulnapp
    networks:
      - app-network
    volumes:
      - ./db/init.sql:/docker-entrypoint-initdb.d/init.sql:Z
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      interval: 30s
      timeout: 10s
      retries: 3

  php:
    build:
      context: .
    volumes:
      - ./src:/var/www/html
    networks:
      - app-network

  nginx:
    image: nginx:latest
    volumes:
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf
      - ./src:/var/www/html
    ports:
      - "5000:80"
    networks:
      - app-network

networks:
  app-network:
    driver: bridge
```

Start the project with `docker compose up -d`

## Local deploy
To build the project locally, first clone the repository and then use the provided `docker-compose.yaml` to build and deploy the project:
```bash
git clone https://github.com/Matte23/vulnerable-file-downloader
cd vulnerable-file-downloader
docker compose up -d
```
