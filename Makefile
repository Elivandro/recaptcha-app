default: env prepare up key-generate npm-install migrate npm-dev
	@echo "--> Your environment is ready to use! Access http://laravel.test and enjoy it!"

.PHONY: env
env:
	@echo "--> Copying .env.example to .env file"
	@cp -n .env.example .env

.PHONY: prepare
prepare:
	@echo "--> Installing composer dependencies..."
	@sudo rm -rf vendor/
	@sh ./bin/prepare.sh

.PHONY: up
up:
	@echo "--> Starting all docker containers..."
	@./vendor/bin/sail up -d

.PHONY: key-generate
key-generate:
	@echo "--> Generating new laravel key..."
	@./vendor/bin/sail art key:generate

.PHONY: npm-install
npm-install:
	@echo "--> Installing NPM dependencies..."
	@sudo rm -rf node_modules/
	@./vendor/bin/sail npm install

.PHONY: migrate
migrate:
	@echo "--> run sail art migrate command..."
	@sleep 10
	@./vendor/bin/sail art migrate:fresh

.PHONY: npm-dev
npm-dev:
	@echo "--> run npm run dev command command..."
	@./vendor/bin/sail npm run dev