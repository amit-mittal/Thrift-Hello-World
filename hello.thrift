namespace java helloworld
namespace php helloworld

struct DummyStruct{
	1: required i64 value;
}

service HelloService {
	string sayHello(1:DummyStruct dummy);
}
