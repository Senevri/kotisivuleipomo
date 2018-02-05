#!/usr/bin/python3
# vim: set expandtab
import os, time
import pysftp

"""
todo: 
    Subdirectories, command line options
    """

server = "servername"
path = "./local/public_html/path"
username = "username"
password = "password"
serverdir= "public_html/path"



def checkfiles( path ):
    print("checkfiles")
    print(path)
    return dict(map(lambda f: ("{}/{}".format(path, f), os.path.getmtime("{}/{}".format(path,f))) if (f[0]!='.') else  (0, 0), os.listdir (path)))

def fileschanged(files):
    files = [elem for elem in files if not (".swp" in elem)]
    if len(files) == 0:
        print("no updated files\n")
        return False
    print(username, password)
    import pysftp
    
    cnopts = pysftp.CnOpts()
    cnopts.hostkeys = None 

    with pysftp.Connection(server, username=username, password=password, cnopts=cnopts) as sftp:
        with sftp.cd(serverdir):
            for f in files:
                sftp.put(f) 
    return True;
    
before=checkfiles(path)

while 1:
    print("looping")
    changedfiles = []
    time.sleep(5)
    after = checkfiles( path )
    if len(before)!=len(after):
        changedfiles.extend([set(after.keys())-set(before.keys())]);
    
    for (a, t) in before.items():
        if a in after.keys():
            if t != after[a]:
                changedfiles.append(a)
    fileschanged(changedfiles)
    before = after
