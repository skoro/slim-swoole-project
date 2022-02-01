## Samples directory

Put here data sample that could be used in your test cases.
You can load a sample data by calling the `loadSample` method
for loading an arbitrary data or `loadJsonSample` for loading
a json like this:

```php
    // load an arbitrary file:
    $mySample = $this->loadSample('sample-file.txt');
    // or load Json:
    $jsonSample = $this->loadJsonSample('sample-file.json');
    $jsonSample['name'] = 'anything';
```
