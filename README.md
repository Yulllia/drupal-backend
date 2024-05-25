# Glossary Module for Drupal

## Overview
This module provides a functionality that will allow admin to add words in the glossary vocabulary. The term can be added through Administrative Panel and add Taxonomy term or using link /admin/structure/glossary/add-term where admin can add title and description to the taxonomy. This module was designed to facilitate building complex pages with consistent design elements and functionality. Implemented also tooltip beheviour with all custom styles, but without ability to change position tooltip on recize.

## Features
Easy Usge: When install the module, the first need create Basic Page with Title and Body, after that need to add Taxonomy Term to Vocabulary and see highlighted word on the content type.
Customizable:  The glossary terms can be added or dele to meet specific project requirements.

## Requirements
Drupal 9.5.x

## Installation
To install this glossary component module, follow these steps:

## Download or Clone the Module:

Clone the module into your Drupal custom modules directory:
git clone [your-module-git-repo-url] /path/to/drupal/web/modules/custom/glossary_module
Enable the Module:

Via the Drupal Admin Interface: Go to Extend, find the "Glossary Tooltip", and enable it.

Via Drush:
drush en glossary_module

Clear Cache:

Clear the cache to ensure the new components load properly:
drush cr
Configuration
This module provides installation glossary vocabulary and ability to add terms to the vocabulary via Form and highlited on the content with possibility to hover on them and see tolltip. To start using these components:

### Create Content:

Go to the content type select Basic Page.
Add new content, add such fields as Title and Body:


### Configure Taxonomy Terms:

Add the desired taxonomy term to the Glossary Terms vocabulary by adding the terms.

DDEV Integration
If you're using DDEV for local development, here's how to work with this module:

Start DDEV:

Open a terminal and navigate to your DDEV project root.
Start the DDEV environment:
ddev start
Launch the Drupal Site:

Open the site in a browser:
ddev launch
Contributing
Contributions are welcome! If you'd like to contribute to this module, please follow these steps:

Fork the Repository:

Fork this GitHub repository to your account.
Create a Branch for Your Changes:

Name the branch descriptively, e.g., feature/add-new-taxonomy-term.
Submit a Pull Request:

Once you've made your changes, submit a pull request describing the updates.
License
[Specify the license under which this module is distributed, e.g., GPL-2.0, MIT, etc.]

Contact
If you have questions or need assistance, feel free to contact [provide contact details or GitHub issues link].
