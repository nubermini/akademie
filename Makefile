check-traefik:
ifeq (,$(shell docker ps -f name=^traefik$$ -q))
	$(error docker container traefik is not running)
endif

.env:
	$(error file .env is missing, see .env.sample)

image:
	@echo "(Re)building docker image"
	docker build --pull --no-cache -t mindhochschulnetzwerk/akademie:latest .

quick-image:
	@echo "Rebuilding docker image"
	docker build -t mindhochschulnetzwerk/akademie:latest .

dev: .env check-traefik
	@echo "Starting DEV Server"
	docker-compose -f docker-compose.base.yml -f docker-compose.dev.yml up -d --force-recreate

prod: .env check-traefik
	@echo "(Re)pulling docker image"
	docker pull mindhochschulnetzwerk/akademie:latest
	@echo "Starting Production Server"
	docker-compose -f docker-compose.base.yml up -d --force-recreate