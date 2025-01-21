# docker/node/Dockerfile
FROM node:18-alpine

WORKDIR /var/www/html

# Salin file package.json dan package-lock.json untuk menginstal dependensi
COPY package*.json ./

RUN npm install && npm run build
