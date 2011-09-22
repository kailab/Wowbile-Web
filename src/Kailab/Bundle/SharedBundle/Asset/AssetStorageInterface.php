<?php

namespace Kailab\Bundle\SharedBundle\Asset;

interface AssetStorageInterface
{
    public function readAsset($name, $namespace);
    public function deleteAsset($name, $namespace);
    public function hasAsset($name, $namespace);
    public function writeAsset(AssetInterface $asset, $namespace);
}
