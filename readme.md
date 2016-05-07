## Remedy API (Shopify API Extension)

Remedy API is a REST-ful resource for extending the current version of the Shopify API, in an intelligent way.


## Usage

### Authentication

Authentication currently is done through a simple request header.
Example:
  Name  - "X-Remedy-Auth"
  Value - "{API KEY GOES HERE}"

### Obtain an API key

The way to get an API key currently is install the Remedy Communicator app, which will display your API key, after installation. Multiple API keys can be given upon request. 

### Rate Limiting

Due to our limited resources, requests must be limited per API key. There are different access levels, with different limitations. Currently these level and restrictions are unknown.

### Caching

We will be caching Shopify API results the first time they are requested and updating the cache thereafter. The data will always be up-to-date with what is currently on Shopify. You may also choose to pre-cache all data for quick retrieval. This can be done by updating your settings in the Remedy Communicator Shopify app.


## License

The Remedy API is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
