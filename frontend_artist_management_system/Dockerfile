FROM node:21-alpine

WORKDIR /app

COPY package.json ./

RUN npm install

EXPOSE 8080

CMD ["npm","run","serve"]

