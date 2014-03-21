<?php

@ini_set('memory_limit', '512M');

if(!function_exists('lcfirst')) {
    function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }
}

if(!function_exists('htmlspecialchars_decode')) {
    function htmlspecialchars_decode($string,$style=ENT_COMPAT) {
        $translation = array_flip(get_html_translation_table(HTML_SPECIALCHARS,$style));
        if($style === ENT_QUOTES){ $translation['&#039;'] = '\''; }
        return strtr($string,$translation);
    }
}

if(!function_exists('array_combine')) {
    function array_combine($arr1, $arr2) {
        $out = array();

        $arr1 = array_values($arr1);
        $arr2 = array_values($arr2);

        foreach($arr1 as $key1 => $value1) {
            $out[(string)$value1] = $arr2[$key1];
        }

        return $out;
    }
}

if(!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $fp = fopen($filename, 'w+');
        if ($fp) {
            fwrite($fp, $data);
            fclose($fp);
        }
    }
}

if(!defined('MagicToolboxParamsClassLoaded')) {

    define('MagicToolboxParamsClassLoaded', true);

    class MagicToolboxParamsClass {
        var $params = array();
        var $generalProfile = 'default';
        var $currentProfile = '';
        var $scope = 'tool';
        var $mapping = array();

        function MagicToolboxParamsClass() {
            $this->params = array($this->generalProfile => array());
            $this->currentProfile = $this->generalProfile;
        }

        function getScope() {
            return $this->scope;
        }

        function setScope($scope) {
            $this->scope = $scope;
        }

        function getProfile() {
            return $this->currentProfile;
        }

        function getProfiles() {
            return array_keys($this->params);
        }

        function setProfile($profile) {
            /*if(!$profile) return false;
            if(!isset($this->params[$profile])) {
                $this->params[$profile] = array();
            }*/
            $this->currentProfile = $profile;
            return true;
        }

        function renameGeneralProfile($profile) {
            if(!$profile) return false;
            if($this->generalProfile != $profile) {
                $this->params[$profile] = $this->params[$this->generalProfile];
                if($this->currentProfile == $this->generalProfile) {
                    $this->currentProfile = $profile;
                }
                unset($this->params[$this->generalProfile]);
                $this->generalProfile = $profile;
            }
            return true;
        }

        function resetProfile() {
            $this->currentProfile = $this->generalProfile;
        }

        function deleteProfile($profile) {
            if(isset($this->params[$profile]) && $profile != $this->generalProfile) {
                if($profile == $this->currentProfile) $this->currentProfile = $this->generalProfile;
                unset($this->params[$profile]);
                return true;
            }
            return false;
        }

        function profileExists($profile) {
            return isset($this->params[$profile]);
        }

        //getArray
        function getParams($profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            return isset($this->params[$profile]) ? $this->params[$profile] : null;
        }

        function getNames($profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            return isset($this->params[$profile]) ? array_keys($this->params[$profile]) : null;
        }

        //appendArray
        function appendParams($params, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            //NOTE: we can't use array_merge because it overwrites the subarrays, and not merge them
            //$this->params[$profile] = array_merge($this->params[$profile], $params);
            foreach($params as $key => $value) {
                if(array_key_exists($key, $this->params[$profile]) && is_array($this->params[$profile][$key])) {
                    $this->params[$profile][$key] = array_merge($this->params[$profile][$key], $value);
                } else {
                    $this->params[$profile][$key] = $value;
                }
            }
            return $this->params[$profile];
        }

        //exists
        function paramExists($id, $profile = '', $strict = true) {
            if(!$profile) $profile = $this->currentProfile;
            return isset($this->params[$profile][$id]) || !$strict && isset($this->params[$this->generalProfile][$id]);
        }

        function removeParam($id, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            if(isset($this->params[$profile][$id])) {
                unset($this->params[$profile][$id]);
            }
        }

        //get
        function getParam($id, $profile = '', $strict = true) {
            if(!$profile) $profile = $this->currentProfile;
            return isset($this->params[$profile][$id]) ? $this->params[$profile][$id] : ((!$strict && isset($this->params[$this->generalProfile][$id])) ? $this->params[$this->generalProfile][$id] : null);
        }

        //set
        function setValue($id, $value, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            if(isset($this->params[$profile][$id])) {
                $this->params[$profile][$id]['value'] = $value;
            } else if(isset($this->params[$this->generalProfile][$id])) {
                $this->params[$profile][$id] = $this->params[$this->generalProfile][$id];
                $this->params[$profile][$id]['value'] = $value;
            } else {
                $this->params[$profile][$id] = array(
                    'id' => $id,
                    'group' => '',
                    'order' => '',
                    'default' => $value,
                    'label' => '',
                    'description' => '',
                    'type' => 'text',
                    'value' => $value,
                    'scope' => ''
                );
            }
        }

        function getValue($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            if($param) {
                return isset($param['value']) ? $param['value'] : $param['default'];
            }
            return null;
        }

        function getDefaultValue($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            return $param ? $param['default'] : null;
        }

        function getValues($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            if($param) {
                return isset($param['values']) ? $param['values'] : array($param['default']);
            } else return null;
        }

        function valuesExists($id, $profile = '', $strict = true) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            return $param ? isset($param['values']) : false;
        }

        function setValues($id, $values, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            if(isset($this->params[$profile][$id])) {
                $this->params[$profile][$id]['values'] = $values;
            } else if(isset($this->params[$this->generalProfile][$id])) {
                $this->params[$profile][$id] = $this->params[$this->generalProfile][$id];
                $this->params[$profile][$id]['values'] = $values;
            } //else param not exists
        }

        function checkValue($id, $value, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            if(!is_array($value)) $value = array($value);
            return in_array(strtolower($this->getValue($id, $profile, $strict)), array_map('strtolower', $value));
        }

        function checkGroup($id, $group/*, $profile = ''*/) {
            //if(!$profile) $profile = $this->currentProfile;
            if(!isset($this->params[$this->generalProfile][$id]['group']) || empty($this->params[$this->generalProfile][$id]['group'])) return false;
            if(!is_array($group)) $group = array($group);
            return in_array(strtolower($this->params[$this->generalProfile][$id]['group']), array_map('strtolower', $group));
        }

        function getLabel($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            return $param ? $param['label'] : null;
        }

        function getDescription($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            if($param) {
                return isset($param['description']) ? $param['description'] : '';
            } else return null;
        }

        function getType($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            return $param ? $param['type'] : null;
        }

        function getSubType($id, $profile = '', $strict = false) {
            if(!$profile) $profile = $this->currentProfile;
            $param = $this->getParam($id, $profile, $strict);
            return $param ? (isset($param['subType']) ? $param['subType'] : null) : null;
        }

        function setSubType($id, $subType, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            if(isset($this->params[$profile][$id])) {
                $this->params[$profile][$id]['subType'] = $subType;
            } else if(isset($this->params[$this->generalProfile][$id])) {
                $this->params[$profile][$id] = $this->params[$this->generalProfile][$id];
                $this->params[$profile][$id]['subType'] = $subType;
            } //else param not exists
        }


        function loadINI($file, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            if(!file_exists($file)) return false;
            $ini = file($file);
            foreach($ini as $num=> $line) {
                $line = trim($line);
                if(empty($line) || in_array(substr($line, 0, 1), array(';','#'))) continue;
                $cur = explode('=', $line, 2);
                if(count($cur) != 2) {
                    error_log("WARNING: You have errors in you INI file ({$file}) on line " . ($num+1) . "!");
                    continue;
                }
                $this->setValue(trim($cur[0]), trim($cur[1]), $profile);
            }
            return true;
        }

        function updateINI($file, $params = null, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            if(!file_exists($file)) return false;
            $iniLines = file($file);
            $iniParams = array();
            foreach($iniLines as $num => $line) {
                $line = trim($line);
                if(empty($line) || in_array(substr($line, 0, 1), array(';','#'))) continue;
                list($id, $value) = explode('=', $line, 2);
                $id = trim($id);
                $iniParams[$id] = $num;
            }
            if($params === null) $params = array_keys($this->params[$profile]);

            foreach($params as $id) {
                if(isset($iniParams[$id])) {
                    $iniLines[$iniParams[$id]] = $id . ' = ' . $this->getValue($id, $profile) . "\n";
                } else {
                    $line = "\n";
                    if(isset($this->params[$profile][$id]['label'])) {
                        $line .= '# ' . $this->params[$profile][$id]['label'] . "\n";
                    }
                    if(isset($this->params[$profile][$id]['description'])) {
                        $line .= '# ' . $this->params[$profile][$id]['description'] . "\n";
                    }
                    if(isset($this->params[$profile][$id]['values'])) {
                        $line .= '# allowed values: ';
                        for($i = 0, $l = count($this->params[$profile][$id]['values']); $i < $l; $i++) {
                            $line .= $this->params[$profile][$id]['values'][$i];
                            if($i < $l-1) $line .= ', ';
                        }
                        $line .= "\n";
                    }
                    $iniLines[] = $line . $id . ' = ' . $this->getValue($id, $profile) . "\n";
                }
            }
            file_put_contents($file, implode("", $iniLines));

            return true;
        }

        function setMapping($mapping = array()) {
            $this->mapping = $mapping;
        }

        function getMapping() {
            return $this->mapping;
        }

        function addMapping($key, $mapping = array()) {
            $this->mapping[$key] = $mapping;
        }

        function removeMapping($key) {
            if(isset($this->mapping[$key])) unset($this->mapping[$key]);
        }

        function serialize($script = false, $delimiter = '', $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            $serializeAll = $profile == $this->generalProfile;
            $str = array();
            foreach($this->getParams($this->generalProfile) as $param) {
                if(!isset($param['scope']) || ($param['scope'] != $this->scope) || !$this->paramExists($param['id'], $profile) || !$serializeAll && $this->checkValue($param['id'], $this->getValue($param['id'], $this->generalProfile), $profile)) {
                    continue;
                }
                $value = $this->getValue($param['id'], $profile);
                if(isset($this->mapping[$param['id']])) {
                    if(is_array($this->mapping[$param['id']])) {
                        if(array_key_exists($value, $this->mapping[$param['id']])) {
                            $value = $this->mapping[$param['id']][$value];
                        }
                    } else/*lambda-style function*/ {
                        $value = $this->mapping[$param['id']]($this);
                    }
                    //add possibility to skip some parameters with a specific value
                    if($value === null) continue;
                }
                if($script) {
                    switch($param['type']) {
                        case 'num':
                        case 'float':
                            if($value != 'auto') break;
                        case 'text':
                        case 'array':
                            if($param['id'] == 'right-click' && in_array($value, array('false', 'true'))) {
                                $value = '\'' . $value . '\'';
                                break;
                            }

                        default:
                            if(in_array($value, array('false', 'true'))) break;
                            $value = '\'' . $value . '\'';
                    }
                    $str[]= '\'' . $param['id'] . '\':' . $value;
                } else /*rel*/ {
                    $str[] = $param['id'] . ':' . $value;
                }
            }
            if(empty($str)) {
                $str = '';
            } else {
                if(!$delimiter) {
                    $delimiter = $script ? ',' : ';';
                }
                $str = implode($delimiter, $str);
                if(!$script) $str .= $delimiter;
            }

            return $str;
        }

        function unserialize($str, $profile = '') {
            if(!$profile) $profile = $this->currentProfile;
            //script version
            //preg_match_all("/'([a-z_\-]+)':'?([^;']*)'?/ui", $str, $matches);
            //rel version
            preg_match_all("/([a-z_\-]+):([^;']*)/ui", $str, $matches);
            if(count($matches[1]) > 0) {
                $options = array_combine($matches[1], $matches[2]);
                //$this->append($options);
                foreach($options as $name => $value) {
                    $this->setValue($name, $value, $profile);
                }
                return true;
            }
            return false;
        }

    }

}

?>
