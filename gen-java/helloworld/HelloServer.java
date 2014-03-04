package helloworld;

import org.apache.thrift.server.TServer;
import org.apache.thrift.server.TThreadPoolServer;
import org.apache.thrift.transport.TServerSocket;
import org.apache.thrift.transport.TTransportException;

public class HelloServer implements Runnable {
	
	private static final int PORT = 9090;
	
	public void run() {
		try {
			TServerSocket serverTransport = new TServerSocket(PORT);
			HelloService.Processor processor = new HelloService.Processor(new HelloServiceImpl());
			TServer server = new TThreadPoolServer(new TThreadPoolServer.Args(serverTransport).processor(processor));
			System.out.println("Starting server on port: "+PORT);
			server.serve();
			
		} catch(TTransportException e) {
			System.out.println("Message: "+e.getMessage());
			System.out.println("StackTrace: ");
			e.printStackTrace();
		}
	}
	
	public static void main(String[] args) {
		new Thread(new HelloServer()).run();
	}
}
