import os, time, ftplib

path = "."
def checkfiles( path ):
	print("checkfiles")
	return dict(map(lambda f: (f, os.path.getmtime(f)), os.listdir (path)))

def fileschanged(files):
	files = [elem for elem in files if not (".swp" in elem)]
	if len(files) == 0:
		print("no updated files\n")
		return False
	session = ftplib.FTP('files.000webhost.com','username','password')
	session.cwd('public_html')
	for f in files:
		print(f)
		myfile = open(f, 'rb')
		session.storbinary('STOR %s' % (myfile), myfile)
		myfile.close
	return True;
	
before=checkfiles(path)

while 1:
	print("looping")
	changedfiles = []
	time.sleep(5)
	after = checkfiles( path )
	if len(before)!=len(after):
		changedfiles.append([set(after.keys())-set(before.keys())]);
	
	for (a, t) in before.items():
		if a in after.keys():
			if t != after[a]:
				changedfiles.append(a)
	fileschanged(changedfiles)
