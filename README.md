# helper
Helpers inside a project


## Using the User Actions Logger ##

#### Have your user entity implement the `UserInterface`. ####

#### Create an implementation of the Abstract `UserAction` class.  This would be a doctrine entity for symfony. ####

Log an action like so:\
``$persister = new Persister();``\
``$loggerService = new LoggerService($persister);``\
``$userAction = new ConcreteUserAction(
 $user,
 $action,
 $resource,
 $resourceId,
 $details
);``\
``$loggerService->log($userAction);``\
See unit tests for example.
