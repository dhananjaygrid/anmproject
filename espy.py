from easysnmp import Session
import time
import datetime
import threading

switch = ['192.168.184.23','192.168.184.98']

class switch_threads(threading.Thread):
    def __init__(self, ip):
        threading.Thread.__init__(self)
        self.ip = ip
        
    def run(self):
        while True:
            failed_attempts = 0
            try:
                session = Session(hostname=self.ip, community = 'public', version=1, timeout =5, retries=3)
            except easysnmp.exceptions.EasySNMPTimeoutError:
                failed_attempts = failed_attempts +1 

            session = Session(hostname=self.ip, community = 'public', version=1)
            time_ = int(time.time())
            probe_time = datetime.datetime.utcfromtimestamp(time_).strftime('%Y-%m-%d %H:%M:%S')
            #new_probe = (datetime.timedelta(seconds=60))
            next_probe = datetime.datetime.now() + datetime.timedelta(seconds=60)
            print "connected to switch",self.ip, "at time",probe_time,"\n", 
            test_all = session.walk('1.3.6.1.2.1.17.4')
            ports = session.walk('IF-MIB::ifName')
            oid_index_ = []
            macs = []

            for i in range(len(test_all)):
                oid = test_all[i].oid
                type_ = test_all[i].snmp_type
                length = len(oid.split('.'))
                if (length >= 12 and  type_ == 'OCTETSTR'):
                    macs.append(test_all[i].value)
        
                if (type_ == 'INTEGER' and "mib-2.17.4.3.1.2" in oid):
        #print test_all[i]
                    oid_index_.append(test_all[i].value)
 
            macs = [(':'.join('%02x' % ord(b) for b in mac)) for mac in macs]
            dict = {}
            for k in range(len(macs)):
                dict[macs[k]] = oid_index_[k]


            dict_1 = {'index':'port'}
            for port in ports:
                dict_1[port.oid_index] = port.value

            port_name = []
            for index in oid_index_:
                if index in dict_1.keys():
                    port_name.append(dict_1[index]) 
        #print index,"----",dict_1[index],
#print port_name

            j = 0
            for name in port_name:
 #   if index in 
                print "mac address:", macs[j],"port", name,"\n",           
                j = j + 1
            #print "\n","next probe time",next_probe, "\n"
            time.sleep(60)
            
threads = []
for ip in switch:
    thread = switch_threads(ip)
    thread.start()
    threads.append(thread)
for t in threads:
    t.join()

