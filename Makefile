SERVICENAME=$(shell grep SERVICENAME .env | sed -e 's/^.\+=//' -e 's/^"//' -e 's/"$$//')

check-traefik:
ifeq (,$(shell docker ps -f name=^traefik$$ -q))
	$(error docker container traefik is not running)
endif

.env:
	$(error file .env is missing, see .env.sample)

image:
	@echo "(Re)building docker image"
	docker build --no-cache -t mindhochschulnetzwerk/$(SERVICENAME):latest .

rebuild:
	@echo "Rebuilding docker image"
	docker build -t mindhochschulnetzwerk/$(SERVICENAME):latest .

dev: .env check-traefik
	@echo "Starting DEV Server"
	docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d --force-recreate --remove-orphans

prod: image .env check-traefik
	@echo "Starting Production Server"
	docker-compose up -d --force-recreate --remove-orphans $(SERVICENAME)

shell:
	docker-compose exec $(SERVICENAME) sh

logs:
	docker-compose logs -f
