# Stage 1: Build the application
ARG NODE_VERSION=24.7.0-alpine
ARG NGINX_VERSION=alpine3.22

FROM node:${NODE_VERSION} as builder

WORKDIR /app

COPY package.json ./

RUN corepack enable yarn

RUN --mount=type=cache,target=/root/.npm yarn install

COPY . .
RUN yarn install
RUN yarn build

# Stage 2: Serve the application with Nginx
FROM nginxinc/nginx-unprivileged:${NGINX_VERSION} AS runner

USER nginx

COPY nginx.conf /etc/nginx/nginx.conf
COPY --chown=nginx:nginx --from=builder /app/dist /usr/share/nginx/html

EXPOSE 8080

ENTRYPOINT ["nginx", "-c", "/etc/nginx/nginx.conf"]
CMD ["-g", "daemon off;"]
