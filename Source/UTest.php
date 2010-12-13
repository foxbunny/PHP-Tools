<?php
/**
 *  UTest: Super-Simple Single-Seat Unit Testing
 *
 *  UTest is a KISS test class that helps you with test basics, while allowing 
 *  you to use familiar tools like assert() and logical operators instead of 
 *  a whole new test framework.
 *
 *  It is meant for single-seat development, wher only one developer is 
 *  involved, and for very simple testing. Of course, the complexity of the 
 *  actial test can be anything you want. Depending on how you write the 
 *  asserts, you can create very complex tests. For any other use-case 
 *  scenario, you should use PHPUnit or SimpleTest, especially if there's more 
 *  than just you in the game.
 *
 *  UTest helps you by taking care of administrative tasks like counting the 
 *  tests you've run, keeping track of failures and passes, and displaying 
 *  notifications. Other than that, it's you and your PHP all the way.
 *
 *  The most simple usage is the testConds() static method. Here's an example:
 *
 *      require 'includes/UTest/UTest.php';
 *      
 *      $a = 1;
 *      $b = 2;
 *
 *      UTest\UTest::testCond(
 *          'Simple test', __LINE__,
 *          assert($a != $b)
 *      );
 *
 *  Running the aboce code produces:
 *
 *      [PASS] Simple test @ line 6
 *      Total tests: 1 Passed: 1 Failed: 0
 *
 *  Here's an example that tests multiple conditions in a single go:
 *
 *      UTest\UTest::testCond(
 *          'More complex', __LINE__,
 *          assert(is_int($a) == TRUE) and
 *          assert(is_int($b) == TRUE) and
 *          assert($a != $b)
 *      );
 *
 *  And this would produce:
 *
 *      [PASS] More complex @ line 6
 *      Total tests: 1 Passed: 1 Failed: 0
 *
 *  And that's about it.
 *
 *  UTest cannot do the following for you: trapping exceptions, mocking, handling 
 *  fixtures, etc. Some of those features may be implemented in future, and 
 *  some may never be implemented. Of course, code is released under (L)GPL, so 
 *  feel free to patch it yrouself with methods you need. If you do so, please 
 *  also let me know.
 *
 *  While UTest does not handling timing, on its own, I have also written the 
 *  Timer class that can be used in conjunction with UTest, and that is the 
 *  combination I usually use.
 *
 *  @author Branko Vukelic
 *  @copyright Copyright (c)2010 by Branko Vukelic. All rights reserved.
 *  @license GPLv3
 *  @version 0.1
 *  @package UTest
 */


namespace UTest;

class UTest {

    public static $passed = 0;
    public static $failed = 0;

    public static function testOk($message, $line='n/a') {
        self::$passed += 1;
        echo "[PASS] $message @ line $line\n";
    }

    public static function testFail($message, $line='n/a', $stop=FALSE) {
        self::$failed += 1;
        if ($stop) {
            die("[FAIL] $message @ line $line: TERMINATING");
        }
        else {
            echo "[FAIL] $message @ line $line\n";
        }
    }

    public static function echoStatus() {
        echo "Total tests: ".(self::$passed + self::$failed);
        echo " Passed: ".self::$passed;
        echo " Failed: ".self::$failed."\n";
    }

    public static function getStatus() {
        return array('passed'=>self::$passed, 'failed'=>self::$failed);
    }

    public static function testConds($msg, $line, $conds, $stop=FALSE) {
        if ($conds) {
            self::testOk($msg, $line);
        }
        else {
            self::testFailed($msg, $line, $stop);
        }
    }
}

?>
