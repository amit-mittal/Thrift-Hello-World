<?php
	// defining the port and server to listen
	define("PORT", '9090');
	define("SERVER", 'localhost');

	//Global variable where the php library files are stored
	//EDIT THIS PART ACCORDING TO YOUR CONFIGURATION
	$GLOBALS['THRIFT_ROOT'] = 'thrift';
	
	//including the library files
	require_once $GLOBALS['THRIFT_ROOT'].'/Thrift.php';
	require_once $GLOBALS['THRIFT_ROOT'].'/protocol/TBinaryProtocol.php';
	require_once $GLOBALS['THRIFT_ROOT'].'/transport/TSocket.php';
	require_once $GLOBALS['THRIFT_ROOT'].'/transport/TBufferedTransport.php';
	
	//loading the auto-generated package
	require_once $GLOBALS['THRIFT_ROOT'].'/gen-php/helloworld/HelloService.php';
	require_once $GLOBALS['THRIFT_ROOT'].'/gen-php/helloworld/Types.php';
?>
<?php
	try {
		//create a thrift connection
		$socket = new TSocket(SERVER, PORT);
		$transport = new TBufferedTransport($socket);
		$protocol = new TBinaryProtocol($transport);
		
		//create a new hello service client
		$client = new HelloServiceClient($protocol);
		
		//open the connection
		$transport->open();
		
		$dummyObj = new DummyStruct();
		$dummyObj->value = 1;

		$result = $client->sayHello($dummyObj);
		echo "Result: ".$result;
		
		$transport->close();
	} catch(TException $tx) {
		echo "Thrift Exception: ".$tx->getMessage()."\r\n";
	}
?>
