## Project Intro

Here will be some text

### Local setup

1. First of all create .env files:
    ````console
    cp .env.example .env
    cd provision/ansible
    cp hosts.example hosts
    cp provision.yml.example provision.yml
    ````
2. Install docker and docker-compose. This project is using docker
3. Then consider reading Makefile and use `make init`

### Production Setup

1. CI/CD will be here soon. For now there is only docker-compose downtime deploy option.
2. For server setup there is ansible provision. Create an ansible playbook from the example given:
    ````console
        cd provision/ansible
        cp provision.yml.example provision.yml
    ````
   Setup playbook and don't forget to create Ansible inventory file in **same folder** (I call it "hosts")
   ````console
        cp hosts.example hosts
   ````
   Consider reading it all and then run `make provision`

   Be careful. This command also includes certbot to setup HTTPS
3. Consider reading Makefile `prepare` and `deploy` commans
4. After setting up all required lines in `.env` run `make prepare` then `make deploy`