# BioSpot - API

## Descrição do Projeto
<b>BioSpot</b> é uma aplicação desenvolvida para facilitar a integração da gestão pública no monitoramento e combate a pragas agrícolas. A plataforma permite o registro de denúncias, análise e mapeamento de focos de pragas, auxiliando na tomada de decisão e resposta rápida contra ameaças agrícolas.

## Tecnologias utilizadas

- Laravel
- Docker
- PostgreSQL
- Redis
- Integração com API para Whatsapp Tecnospeed

## Instalação inicial

1. Caso esteja utilizando Windows, instale o WSL2 e o Ubuntu 20.04 LTS. Documentação disponível em : https://learn.microsoft.com/pt-br/windows/wsl/install
2. Clone o repositório de https://github.com/Pablo304/biospot
3. No terminal, instale o make: ```sudo apt install make```
4. Copie o arquivo ```.env.example``` para ```.env``` e preencha com as informações necessárias
5. Entre no diretório do projeto: ```cd biospot```
6. Instale as dependências: ```make install```
7. Irá ser instalado todo o ambiente necessário para rodar o projeto
8. Grande parte das configurações podem ser customizadas a partir de variáveis no arquvi ```.env```

