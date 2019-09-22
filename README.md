# About this component

Het "Tabellen" component voorziet in een implementatiestrategie voor applicaties  die afhankelijk zijn van gegevens die op dit moment nog niet op Common Ground beschikbaar zijn, of nog niet op de manier waarop we deze beschikbaar willen hebben. Voorbeelden hiervan zijn de [RVIG Landelijke tabellen]( https://publicaties.rvig.nl/Landelijke_tabellen) en een Koppeltabel voor gemeentecodes naar RSIN. 

Het component biedt hierbij de mogelijkheid om deze bronnen te benaderen en te gebruiken als REST API (dus bijvoorbeeld de gemeentelijst te doorzoeken) conform de NL API strategie. Teruggegeven bronnen zijn voorzien van een URI endpoint waardoor deze gebruikt kunnen worden als bron. 

Hierbij is het nadrukkelijk mogelijk dat deze bronnen in de toekomst binnen dit component komen te vervallen doordat  zij zichzelf ontsluiten. In dat geval zal de URI door middel van een 301 redirect  worden doorverwezen naar de nieuwe bron. Hierdoor wordt continuiteit van verwijzingen geborgd.

Uiteindelijk faciliteert het component hiermee een methode om blokkerende externe dependencies terug te brengen. Door deze als het ware Common Ground op te trekken als koppeltabel. Hiermee is het mogelijk om implementaties inktvlek gewijs uit te voeren waarbij component voor component wordt overgetrokken terwijl een eventuele applicatie reeds in productie is.

## Documentation

- [Installation manual](https://github.com/ConductionNL/bzk-tabellen/blob/master/INSTALLATION.md).
- [contributing](https://github.com/ConductionNL/bzk-tabellen/blob/master/CONTRIBUTING.md) for tips tricks and general rules concerning contributing to this component.
- [codebase](https://github.com/ConductionNL/bzk-tabellen) on github.
- [codebase](https://github.com/ConductionNL/bzk-tabellen/archive/master.zip) as a download.

## Features
This repository uses the power of the [commonground proto component](https://github.com/ConductionNL/commonground-component) provide common ground specific functionality based on the [VNG Api Strategie](https://docs.geostandaarden.nl/api/API-Strategie/). Including  

* Build in support for public API's like BAG (Kadaster), KVK (Kamer van Koophandel)
* Build in validators for common dutch variables like BSN (Burger service nummer), RSIN(), KVK(), BTW()
* AVG and VNG proof audit trails, Wildcard searches, handling of incomplete date's and underInvestigation objects
* Support for NLX headers
* And [much more](https://github.com/ConductionNL/commonground-component) .... 

## License

Copyright � Conduction 2019

Licensed under [EUPL](https://github.com/ConductionNL/bzk-tabellen/blob/master/LICENSE.md)

## Credits

[![Conduction](https://raw.githubusercontent.com/ConductionNL/bzk-tabellen/master/resources/logo-conduction.svg?sanitize=true "Conduction")](https://www.conduction.nl/)



