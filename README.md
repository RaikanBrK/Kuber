# Library Kuber
Kuber é uma biblioteca altamente eficiente criada com Laravel, que visa simplificar e agilizar o desenvolvimento de sites. Com um painel administrativo já configurado, a biblioteca permite que os desenvolvedores se concentrem em criar sites de qualidade, em vez de passar tempo configurando um ambiente.

Com recursos como gerenciamento de usuários, gerenciamento de conteúdo e suporte para vários idiomas, Kuber oferece uma solução completa para o desenvolvimento de sites. 

## Instalação
Adicionando repositório
```
composer require raikanbrk/kuber
```

### Instalando Kuber
```
php artisan kuber:install
```

### Instalar migrations
```
php artisan migrate --seed
```
Ou
```
php artisan migrate:fresh --seed
```

### Criando link simbólico
```
php artisan storage:link
```

### Instalando dependências do node
```
npm install
```
