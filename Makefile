bold=`tput bold`
green=`tput setaf 2`
reset=`tput sgr0`

help:
	@echo "${bold}Docker containers manipulation commands${reset}"
	@echo "${green}up${reset}			Start containers in background mode"
	@echo "${green}down${reset}			Stops containers and removes containers, networks, volumes, and images created by \`up\`"
	@echo "${green}status,ps${reset}		Show containers process status"
	@echo ""
	@echo "${bold}Interactive terminals${reset}"
	@echo "${green}console,sh${reset}		Web container console as www-data user"
	@echo ""

# Docker containers manipulation commands ##############################################################################

.env:
	@echo "👷 ${green}Making env file...${reset}"
	@cp .env.example .env
	@sed -i "s/WWWUSER=.*/WWWUSER=`id -u`/" .env
	@sed -i "s/WWWGROUP=.*/WWWGROUP=`id -g`/" .env

vendor:
	@echo "🏃 ${green}Running composer install...${reset}"
	@docker run --rm --interactive --tty --volume `pwd`:/app --volume `${COMPOSER_HOME:-$HOME/.composer}`:/tmp composer install

setup: .env vendor
	@echo "🏃 ${green}Running setup...${reset}"
	@docker compose exec --user=sail php php artisan key:generate
	@docker compose exec --user=sail php php artisan migrate:fresh
	@docker compose exec --user=sail php php artisan db:seed

up:
	@./vendor/bin/sail up -d

down:
	@./vendor/bin/sail down

ps:
	@docker compose ps -a

# Interactive terminals ################################################################################################

sh console:
	@docker compose exec --user=sail php bash

# Quality tools ########################################################################################################

sa:
	@echo "🏃 ${green}Running PHP Static Analysis Tool...${reset}"
	@docker compose exec --user sail php vendor/bin/phpstan

# artisan commands #####################################################################################################

fresh-db:
	@docker compose run --rm php php artisan migrate:fresh
	@docker compose run --rm php php artisan db:seed
