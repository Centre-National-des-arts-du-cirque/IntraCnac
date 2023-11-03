
<p align="center">
<a href=https://github.com/Centre-National-des-arts-du-cirque/SupportWebsiteFinal target="_blank">
<img src='public/img/CNAC_logo.png' width="100%" alt="Banner" />
</a>
</p>

<p align="center">
<img src="https://img.shields.io/github/contributors/Centre-National-des-arts-du-cirque/SupportWebsiteFinal" alt="GitHub contributors" />
<img src="https://img.shields.io/github/discussions/Centre-National-des-arts-du-cirque/SupportWebsiteFinal" alt="GitHub discussions" />
<img src="https://img.shields.io/github/issues/Centre-National-des-arts-du-cirque/SupportWebsiteFinal" alt="GitHub issues" />
<img src="https://img.shields.io/github/issues-pr/Centre-National-des-arts-du-cirque/SupportWebsiteFinal" alt="GitHub pull request" />
</p>

<p></p>
<p></p>

## 🔍 Table of Contents

- [🔍 Table of Contents](#-table-of-contents)
- [💻 Stack](#-stack)
- [📝 Project Summary:](#-project-summary)
- [⚙️ Setting Up](#️-setting-up)
    - [Your Environment Variable](#your-environment-variable)
- [🚀 Run Locally](#-run-locally)
- [🙌 Contributors](#-contributors)
- [📄 License](#-license)

## 💻 Stack

- [symfony/framework-bundle](https://symfony.com/doc/current/bundles/FrameworkBundle/index.html): Provides the core functionality for the Symfony framework.
- [doctrine/orm](https://www.doctrine-project.org/projects/orm.html): Object-Relational Mapping (ORM) library for database abstraction and persistence.
- [symfony/security-bundle](https://symfony.com/doc/current/security.html): Handles authentication, authorization, and other security-related tasks.
- [symfony/twig-bundle](https://symfony.com/doc/current/templating.html): Integrates the Twig template engine into Symfony.
- [symfony/form](https://symfony.com/doc/current/forms.html): Handles form creation, rendering, and validation.
- [symfony/validator](https://symfony.com/doc/current/validation.html): Provides a set of validators for data validation.
- [doctrine/doctrine-fixtures-bundle](https://github.com/doctrine/DoctrineFixturesBundle): Offers tools for loading test data into the database for testing or development purposes.
- [symfony/maker-bundle](https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html): Provides code generation commands to speed up development.
- [symfony/ux-chart.js](https://symfony.com/bundles/ux-chartjs/current/index.html): Integrate chart.js but in php.
- [symfony/asset-mapper](https://symfony.com/doc/current/frontend/asset_mapper.html): Provide mapping and assets versionnings
- []

## 📝 Project Summary:

INTRACNAC is a intranet created for the Centre nationales des arts du cirque to  communicate and centralise collaborative tools developed specifically for Cnac's needs. In the long term, it will reduce the need to send emails, facilitate the organisation of different activities and automate certain tasks.

- [**src**](src): Contains the main PHP source code files for the project.
- [**public**](public): Holds the publicly accessible files, such as the entry point for the application.
- [**templates**](templates): Contains the HTML templates used for rendering views.
- [**assets**](assets): Stores static assets like JavaScript, CSS, and images used in the project.
- [**config**](config): Holds configuration files for the project, including routes and packages.
- [**bin**](bin): Contains executable scripts or command-line tools related to the project.
- [**migrations**](migrations): Stores database migration files for managing database schema changes.
- [**docs**](docs): Holds project documentation files, such as user guides or API documentation.
- [**docker**](docker): Contains Docker-related files for setting up development or deployment environments.
- [**src/Controller**](src/Controller): Holds the PHP controllers responsible for handling HTTP requests.

## ⚙️ Setting Up

#### Your Environment Variable

- Step 1

- Step 2

## 🚀 Run Locally

1.Clone the SupportWebsiteFinal repository:

```sh
git clone https://github.com/Centre-National-des-arts-du-cirque/SupportWebsiteFinal
```

2.Install the dependencies with one of the package managers listed below:

```bash
composer install
```

3.Build fresh docker images:

```bash
 docker compose build --no-cache
```

4.Start the database:

```bash
docker compose up --pull -d --wait
```

3.Start the development mode:

```bash
symfony serve
```

## 🙌 Contributors

<table style="border:1px solid #404040;text-align:center;width:100%">
<tr><td style="width:14.29%;border:1px solid #404040;">
        <a href="https://github.com/tomStory9" spellcheck="false">
          <img src="https://avatars.githubusercontent.com/u/97254191?v=4?s=100" width="100px;" alt="tomStory9"/>
          <br />
          <b>tomStory9</b>
        </a>
        <br />
        <a href="https://github.com/Centre-National-des-arts-du-cirque/SupportWebsiteFinal/commits?author=tomStory9" title="Contributions" spellcheck="false">
          150 contributions
        </a>
      </td></table>

## 📄 License

This project is licensed under the **MIT License** - see the [**MIT License**](https://github.com/Centre-National-des-arts-du-cirque/SupportWebsiteFinal/blob/master/LICENSE) file for details.
