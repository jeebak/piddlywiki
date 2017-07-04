SHELL=/bin/bash

server:
	@$(SHELL) ./scripts/server

get-Git.php:
	@curl -o Git.php https://raw.githubusercontent.com/kbjr/Git.php/master/Git.php
