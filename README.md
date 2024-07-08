LIBRERIA MYSQL PARA DPS
=

Como es un repositorio privado, para agregar esta libreria en un sistema hay que configurar composer de la siguiente manera:

*Composer.json*
```
{
  "require" : {
    ...
    "dps/mysql": "*"
    ...
  },
  "repositories": [
  {
      "type": "vcs",
      "url": "git@github.com:marcoas/mysql.git"
    }
  ],      
}
```

Para dar permisos a ese repositorio se deberá crear otro arhivo con el token de acceso a GITHUB
Este archivo además, por contener una clave, debe estar agregado a `.gitignore`

*auth.json*
```
{
    "github-oauth": {
        "github.com": "TOKEN DE ACCESO A GITHUB"
    }   
}
```

Los token son creados desde [esta web](https://github.com/settings/tokens)