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

up:
	@./vendor/bin/sail up -d

down:
	@./vendor/bin/sail down

ps status:
	@docker-compose ps -a

# Interactive terminals ################################################################################################

sh console:
	@if ! docker-compose ps --service --filter 'status=running' | grep php > /dev/null; then ./vendor/bin/sail up -d && echo; fi
	@docker-compose exec --user=sail php bash
