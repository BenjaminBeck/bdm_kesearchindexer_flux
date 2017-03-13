# KeSearch indexer for fluid content

This is intended for fluid content registered as content element (with own CType) since version 8.x of flux (https://fluidtypo3.org/)

## Getting Started

1. Install extension
2. Create indexer

### Prerequisites

You need to specify which form fields are allowes to be indexed.
For this you use a flux variable ``allowKeSearchIndex``.

Example RTE Field:

```xml
<flux:field.text name="text1" label="Text 1" cols="10" rows="5" defaultExtras="richtext[*]:rte_transform[mode=ts_css]:options=[RTESmallWidth=250]" enableRichText="1">
    <flux:form.variable name="allowKeSearchIndex" value="true"/>
</flux:field.text>
```

## Built With

* [Fluid Powered TYPO3](https://fluidtypo3.org/)
* [Faceted Search](https://typo3.org/extensions/repository/view/ke_search)

