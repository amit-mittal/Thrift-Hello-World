package helloworld;

import org.apache.thrift.TException;

public class HelloServiceImpl implements HelloService.Iface {
	
	public String sayHello(DummyStruct dummy) throws TException {
		if(dummy.value == 1)
			return "Hello World!!";
		else
			return "Value should be 1 to get my Hello";
	}
}
